package br.ifc.multitenant;

import java.io.IOException;
import java.util.Map;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

@WebServlet("/login")
public class LoginServlet extends Base {

    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        req.getRequestDispatcher("/WEB-INF/login.jsp").forward(req, resp);
    }

    @Override
    protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        Map<String, Object> u = Dao.autenticar(param(req, "empresa"), param(req, "usuario"), req.getParameter("senha") == null ? "" : req.getParameter("senha"));
        if (u == null) {
            falhar(req, resp, "Empresa, usuário ou senha inválidos.");
            return;
        }
        int usuarioId = ((Number) u.get("usuarioId")).intValue();
        if (Dao.conflita(Dao.empresasDoUsuario(usuarioId))) {
            falhar(req, resp, "Acesso bloqueado: usuário vinculado a empresas com conflito de interesses.");
            return;
        }
        HttpSession antiga = req.getSession(false);
        if (antiga != null) {
            antiga.invalidate();
        }
        HttpSession s = req.getSession(true);
        s.setAttribute("usuarioId", usuarioId);
        s.setAttribute("login", u.get("login"));
        s.setAttribute("admin", "ADMIN".equals(u.get("tipo")));
        s.setAttribute("empresaId", ((Number) u.get("empresaId")).intValue());
        s.setAttribute("empresaNome", u.get("empresaNome"));
        resp.sendRedirect(req.getContextPath() + "/app/noticias");
    }

    private void falhar(HttpServletRequest req, HttpServletResponse resp, String msg) throws ServletException, IOException {
        req.setAttribute("erro", msg);
        req.getRequestDispatcher("/WEB-INF/login.jsp").forward(req, resp);
    }
}
