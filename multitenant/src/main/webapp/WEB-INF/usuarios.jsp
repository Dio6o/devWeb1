<%@ page contentType="text/html;charset=UTF-8" %>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro de usuários</title>
    <link rel="stylesheet" href="${pageContext.request.contextPath}/estilo.css">
</head>
<body>
    <%@ include file="menu.jspf" %>
    <h2>Cadastrar usuário</h2>
    <c:if test="${not empty erro}"><p class="erro"><c:out value="${erro}"/></p></c:if>
    <c:if test="${not empty msg}"><p class="ok"><c:out value="${msg}"/></p></c:if>
    <form method="post" action="${pageContext.request.contextPath}/app/usuarios">
        <input name="login" placeholder="Usuário" maxlength="50" required>
        <input name="senha" type="password" placeholder="Senha" required>
        <select name="tipo">
            <option value="COMUM">Comum</option>
            <option value="ADMIN">Administrador</option>
        </select>
        <fieldset>
            <legend>Empresas</legend>
            <c:forEach var="e" items="${empresas}">
                <label><input type="checkbox" name="empresas" value="${e.id}"> <c:out value="${e.nome}"/></label><br>
            </c:forEach>
        </fieldset>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
