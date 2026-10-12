package br.ifc.multitenant;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/noticias")
public class PublicoServlet extends Base {

    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        req.setAttribute("itens", Dao.consultar(
                "SELECT e.nome AS empresa, n.titulo, n.texto, DATE_FORMAT(n.criada_em, '%d/%m/%Y %H:%i') AS data "
                + "FROM noticia n JOIN empresa e ON e.id = n.empresa_id ORDER BY n.id DESC"));
        req.getRequestDispatcher("/WEB-INF/publico.jsp").forward(req, resp);
    }
}
