<%@ page contentType="text/html;charset=UTF-8" %>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="${pageContext.request.contextPath}/estilo.css">
</head>
<body>
    <h2>Login</h2>
    <c:if test="${not empty erro}"><p class="erro"><c:out value="${erro}"/></p></c:if>
    <form method="post" action="${pageContext.request.contextPath}/login">
        <input name="empresa" placeholder="Empresa" value="<c:out value='${param.empresa}'/>" required>
        <input name="usuario" placeholder="Usuário" value="<c:out value='${param.usuario}'/>" required>
        <input name="senha" type="password" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
    <a href="${pageContext.request.contextPath}/noticias">Ver notícias</a>
</body>
</html>
