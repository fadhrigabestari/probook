package utilities;

import java.sql.*;

public class SQLConnect {
    public static Connection connection;
    public static Connection connectionProbook;
    public static PreparedStatement stmt;

    public static void getConnection() throws ClassNotFoundException, SQLException {
        String driver = Config.driver;
        String database = Config.database1;
        String user = Config.user;
        String password = Config.password;
        Class.forName(driver);
        connection = DriverManager.getConnection(database, user, password);
    }

    public static void getConnectionProbook() throws ClassNotFoundException, SQLException {
        String driver = Config.driver;
        String database = Config.database2;
        String user = Config.user;
        String password = Config.password;
        Class.forName(driver);
        connectionProbook = DriverManager.getConnection(database, user, password);
    }

    public static void closeConnection() throws SQLException {
        connection.close();
    }

    public static void closeConnectionProbook() throws SQLException {
        connectionProbook.close();
    }
}
