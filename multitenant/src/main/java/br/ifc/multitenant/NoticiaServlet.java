package br.ifc.multitenant;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/app/noticias")
public class NoticiaServlet extends Base {

    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        req.setAttribute("itens", Dao.consultar(
                "SELECT titulo, texto, DATE_FORMAT(criada_em, '%d/%m/%Y %H:%i') AS data FROM noticia WHERE empresa_id = ? ORDER BY id DESC",
                empresaId(req)));
        req.getRequestDispatcher("/WEB-INF/noticias.jsp").forward(req, resp);
    }

    @Override
    protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        String titulo = param(req, "titulo");
        String texto = param(req, "texto");
        if (!titulo.isEmpty() && !texto.isEmpty()) {
            Dao.executar("INSERT INTO noticia (empresa_id, titulo, texto) VALUES (?, ?, ?)", empresaId(req), titulo, texto);
        }
        resp.sendRedirect(req.getContextPath() + "/app/noticias");
    }
}
