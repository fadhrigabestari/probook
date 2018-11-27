package utilities;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.ResultSet;

public class SQLConnect {
    static String driver = "com.mysql.jdbc.Driver";
    static String database = "jdbc:mysql://localhost:3307/probook";
    static String user = "root";
    static String password = "haruka3798";

    static Connection connection;

    public static void getConnection() throws ClassNotFoundException, SQLException {
        Class.forName(driver);
        connection = DriverManager.getConnection(database,user,password);
    }

    public static ResultSet execQuery(String query) throws SQLException {
        Statement stmt = connection.createStatement();
        return stmt.executeQuery(query);
    }

    public static void closeConnection() throws SQLException {
        connection.close();
    }
}
