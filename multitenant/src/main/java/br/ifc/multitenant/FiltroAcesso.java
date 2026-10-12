package br.ifc.multitenant;

import java.io.IOException;
import javax.servlet.Filter;
import javax.servlet.FilterChain;
import javax.servlet.ServletException;
import javax.servlet.ServletRequest;
import javax.servlet.ServletResponse;
import javax.servlet.annotation.WebFilter;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

@WebFilter("/*")
public class FiltroAcesso implements Filter {

    @Override
    public void doFilter(ServletRequest req, ServletResponse res, FilterChain chain) throws IOException, ServletException {
        HttpServletRequest rq = (HttpServletRequest) req;
        HttpServletResponse rs = (HttpServletResponse) res;
        rq.setCharacterEncoding("UTF-8");
        String caminho = rq.getServletPath();
        if (caminho.startsWith("/app/")) {
            HttpSession s = rq.getSession(false);
            if (s == null || s.getAttribute("usuarioId") == null) {
                rs.sendRedirect(rq.getContextPath() + "/login");
                return;
            }
            if (caminho.equals("/app/usuarios") && !Boolean.TRUE.equals(s.getAttribute("admin"))) {
                rs.sendError(HttpServletResponse.SC_FORBIDDEN);
                return;
            }
        }
        chain.doFilter(req, res);
    }
}
