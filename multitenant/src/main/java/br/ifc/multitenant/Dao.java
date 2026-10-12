package br.ifc.multitenant;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.LinkedHashMap;
import java.util.List;
import java.util.Map;
import java.util.Set;
import java.util.TreeSet;

public class Dao {

    public static List<Map<String, Object>> consultar(String sql, Object... params) {
        try (Connection c = Db.get(); PreparedStatement s = c.prepareStatement(sql)) {
            for (int i = 0; i < params.length; i++) {
                s.setObject(i + 1, params[i]);
            }
            try (ResultSet r = s.executeQuery()) {
                ResultSetMetaData m = r.getMetaData();
                List<Map<String, Object>> linhas = new ArrayList<>();
                while (r.next()) {
                    Map<String, Object> linha = new LinkedHashMap<>();
                    for (int i = 1; i <= m.getColumnCount(); i++) {
                        linha.put(m.getColumnLabel(i), r.getObject(i));
                    }
                    linhas.add(linha);
                }
                return linhas;
            }
        } catch (SQLException e) {
            throw new IllegalStateException(e);
        }
    }

    public static void executar(String sql, Object... params) {
        try (Connection c = Db.get(); PreparedStatement s = c.prepareStatement(sql)) {
            for (int i = 0; i < params.length; i++) {
                s.setObject(i + 1, params[i]);
            }
            s.executeUpdate();
        } catch (SQLException e) {
            throw new IllegalStateException(e);
        }
    }

    public static Map<String, Object> autenticar(String empresa, String login, String senha) {
        List<Map<String, Object>> r = consultar(
                "SELECT u.id AS usuarioId, u.login, u.tipo, e.id AS empresaId, e.nome AS empresaNome "
                + "FROM usuario u "
                + "JOIN usuario_empresa ue ON ue.usuario_id = u.id "
                + "JOIN empresa e ON e.id = ue.empresa_id "
                + "WHERE e.nome = ? AND u.login = ? AND u.senha = SHA2(?, 256)",
                empresa, login, senha);
        return r.isEmpty() ? null : r.get(0);
    }

    public static Set<Integer> empresasDoUsuario(int usuarioId) {
        Set<Integer> ids = new TreeSet<>();
        for (Map<String, Object> m : consultar("SELECT empresa_id FROM usuario_empresa WHERE usuario_id = ?", usuarioId)) {
            ids.add(((Number) m.get("empresa_id")).intValue());
        }
        return ids;
    }

    public static List<Map<String, Object>> empresas(Set<Integer> ids) {
        List<Map<String, Object>> resultado = new ArrayList<>();
        for (Map<String, Object> m : consultar("SELECT id, nome FROM empresa ORDER BY nome")) {
            if (ids.contains(((Number) m.get("id")).intValue())) {
                resultado.add(m);
            }
        }
        return resultado;
    }

    public static boolean conflita(Set<Integer> ids) {
        for (Map<String, Object> m : consultar("SELECT id, conflitos FROM empresa")) {
            if (!ids.contains(((Number) m.get("id")).intValue())) {
                continue;
            }
            for (String c : String.valueOf(m.get("conflitos")).split(",")) {
                c = c.trim();
                if (!c.isEmpty() && ids.contains(Integer.parseInt(c))) {
                    return true;
                }
            }
        }
        return false;
    }

    public static boolean loginExiste(String login) {
        return !consultar("SELECT id FROM usuario WHERE login = ?", login).isEmpty();
    }

    public static void criarUsuario(String login, String senha, String tipo, Set<Integer> empresas) {
        try (Connection c = Db.get()) {
            c.setAutoCommit(false);
            try {
                int id;
                try (PreparedStatement s = c.prepareStatement(
                        "INSERT INTO usuario (login, senha, tipo) VALUES (?, SHA2(?, 256), ?)",
                        Statement.RETURN_GENERATED_KEYS)) {
                    s.setString(1, login);
                    s.setString(2, senha);
                    s.setString(3, tipo);
                    s.executeUpdate();
                    try (ResultSet k = s.getGeneratedKeys()) {
                        k.next();
                        id = k.getInt(1);
                    }
                }
                try (PreparedStatement s = c.prepareStatement(
                        "INSERT INTO usuario_empresa (usuario_id, empresa_id) VALUES (?, ?)")) {
                    for (int empresa : empresas) {
                        s.setInt(1, id);
                        s.setInt(2, empresa);
                        s.addBatch();
                    }
                    s.executeBatch();
                }
                c.commit();
            } catch (SQLException e) {
                c.rollback();
                throw e;
            }
        } catch (SQLException e) {
            throw new IllegalStateException(e);
        }
    }
}
