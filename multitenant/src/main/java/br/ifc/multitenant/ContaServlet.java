package br.ifc.multitenant;

import java.io.IOException;
import java.math.BigDecimal;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/app/contas")
public class ContaServlet extends Base {

    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        req.setAttribute("itens", Dao.consultar(
                "SELECT descricao, valor, DATE_FORMAT(criada_em, '%d/%m/%Y %H:%i') AS data FROM conta WHERE empresa_id = ? ORDER BY id DESC",
                empresaId(req)));
        req.getRequestDispatcher("/WEB-INF/contas.jsp").forward(req, resp);
    }

    @Override
    protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        String descricao = param(req, "descricao");
        try {
            BigDecimal valor = new BigDecimal(param(req, "valor").replace(",", "."));
            if (!descricao.isEmpty()) {
                Dao.executar("INSERT INTO conta (empresa_id, descricao, valor) VALUES (?, ?, ?)", empresaId(req), descricao, valor);
            }
        } catch (NumberFormatException e) {
        }
        resp.sendRedirect(req.getContextPath() + "/app/contas");
    }
}
