package br.ifc.multitenant;

import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;

public abstract class Base extends HttpServlet {

    protected String param(HttpServletRequest req, String nome) {
        String v = req.getParameter(nome);
        return v == null ? "" : v.trim();
    }

    protected int usuarioId(HttpServletRequest req) {
        return (Integer) req.getSession().getAttribute("usuarioId");
    }

    protected int empresaId(HttpServletRequest req) {
        return (Integer) req.getSession().getAttribute("empresaId");
    }
}
