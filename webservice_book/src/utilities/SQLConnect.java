package utilities;

import java.sql.*;

public class SQLConnect {
    public static Connection connection;
    public static PreparedStatement stmt;

    public static void getConnection() throws ClassNotFoundException, SQLException {
        String driver = Config.driver;
        String database = Config.database;
        String user = Config.user;
        String password = Config.password;
        Class.forName(driver);
        connection = DriverManager.getConnection(database,user,password);
    }

    public static void closeConnection() throws SQLException {
        connection.close();
    }
}
