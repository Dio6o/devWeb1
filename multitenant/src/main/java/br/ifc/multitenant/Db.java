package br.ifc.multitenant;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class Db {

    static {
        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
        } catch (ClassNotFoundException e) {
            throw new ExceptionInInitializerError(e);
        }
    }

    public static Connection get() throws SQLException {
        return DriverManager.getConnection(
                "jdbc:mysql://localhost:3306/multitenant?useSSL=false&allowPublicKeyRetrieval=true&serverTimezone=UTC",
                "root", "root");
    }
}
