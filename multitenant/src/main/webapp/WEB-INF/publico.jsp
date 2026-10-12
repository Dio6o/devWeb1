<%@ page contentType="text/html;charset=UTF-8" %>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Notícias</title>
    <link rel="stylesheet" href="${pageContext.request.contextPath}/estilo.css">
</head>
<body>
    <nav>
        <span>Notícias</span>
        <c:choose>
            <c:when test="${not empty sessionScope.usuarioId}">
                <a href="${pageContext.request.contextPath}/app/noticias">Área restrita</a>
                <a href="${pageContext.request.contextPath}/logout">Sair</a>
            </c:when>
            <c:otherwise>
                <a href="${pageContext.request.contextPath}/login">Entrar</a>
            </c:otherwise>
        </c:choose>
    </nav>
    <c:forEach var="n" items="${itens}">
        <article>
            <h3><c:out value="${n.titulo}"/></h3>
            <small><c:out value="${n.empresa}"/> · <c:out value="${n.data}"/></small>
            <p><c:out value="${n.texto}"/></p>
        </article>
    </c:forEach>
    <c:if test="${empty itens}"><p>Nenhuma notícia publicada.</p></c:if>
</body>
</html>
