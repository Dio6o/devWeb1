package br.ifc.multitenant;

import java.io.IOException;
import java.util.Set;
import java.util.TreeSet;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/app/usuarios")
public class UsuarioServlet extends Base {

    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        exibir(req, resp);
    }

    @Override
    protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        Set<Integer> administradas = Dao.empresasDoUsuario(usuarioId(req));
        String login = param(req, "login");
        String senha = param(req, "senha");
        String tipo = "ADMIN".equals(param(req, "tipo")) ? "ADMIN" : "COMUM";
        Set<Integer> escolhidas = new TreeSet<>();
        String[] marcadas = req.getParameterValues("empresas");
        if (marcadas != null) {
            for (String m : marcadas) {
                try {
                    escolhidas.add(Integer.parseInt(m));
                } catch (NumberFormatException e) {
                }
            }
        }
        if (login.isEmpty() || senha.isEmpty() || escolhidas.isEmpty()) {
            req.setAttribute("erro", "Preencha usuário, senha e selecione ao menos uma empresa.");
        } else if (!administradas.containsAll(escolhidas)) {
            req.setAttribute("erro", "Você só pode vincular usuários às empresas que administra.");
        } else if (Dao.conflita(escolhidas)) {
            req.setAttribute("erro", "As empresas selecionadas possuem conflito de interesses entre si.");
        } else if (Dao.loginExiste(login)) {
            req.setAttribute("erro", "Nome de usuário já existe.");
        } else {
            Dao.criarUsuario(login, senha, tipo, escolhidas);
            req.setAttribute("msg", "Usuário cadastrado.");
        }
        exibir(req, resp);
    }

    private void exibir(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        req.setAttribute("empresas", Dao.empresas(Dao.empresasDoUsuario(usuarioId(req))));
        req.getRequestDispatcher("/WEB-INF/usuarios.jsp").forward(req, resp);
    }
}
