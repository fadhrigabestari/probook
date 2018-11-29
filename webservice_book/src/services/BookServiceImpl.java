
package services;

import java.net.HttpURLConnection;
import java.net.URL;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.Set;
import java.io.IOException;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import javax.jws.WebService;
// import org.json.JSONException;
import org.json.JSONObject;
import org.json.JSONArray;
import java.util.Arrays;


import models.Book;
import utilities.BookServiceUtil;
import utilities.HttpConnect;
import utilities.SQLConnect;

import static utilities.BookServiceUtil.getConnection;
import static utilities.BookServiceUtil.toJSON;

@WebService(endpointInterface = "services.BookService")
public class BookServiceImpl implements BookService {
    @Override
    public Book[] searchBook(String title_input) throws IOException {
        Book[] array_book = new Book[1];
        title_input = title_input.replace(' ', '+');
        String get_url = "https://www.googleapis.com/books/v1/volumes?q=" + title_input;
        System.out.println(get_url);
        URL url = new URL(get_url);
        HttpURLConnection con = (HttpURLConnection) url.openConnection();
        int responseCode = getConnection(con);
        if (responseCode == HttpURLConnection.HTTP_OK) {
            // success
            JSONObject json = toJSON(con);
            JSONArray books = json.getJSONArray("items");
            int count_books = books.length();
            array_book = new Book[count_books+1];

            for (int i=0; i<count_books; i++) {

                //get title
                String title = books.getJSONObject(i).getJSONObject("volumeInfo").getString("title");
                String idBook = books.getJSONObject(i).getString("id");

                //get description
                String description="No description";
                if (!books.getJSONObject(i).getJSONObject("volumeInfo").isNull("description"))
                    description = books.getJSONObject(i).getJSONObject("volumeInfo").getString("description");

                //get authors
                String[] authors = new String[1];
                if (!books.getJSONObject(i).getJSONObject("volumeInfo").isNull("authors")) {
                    JSONArray authors_array = books.getJSONObject(i).getJSONObject("volumeInfo").getJSONArray("authors");
                    authors = new String[authors_array.length()];
                    for (int j=0; j< authors_array.length(); j++) {
                        authors[j] = authors_array.getString(j);
                    }
                } else authors[0] = "Anonymous";


                //get cover
                String cover="https://d3525k1ryd2155.cloudfront.net/i/en/n/no-image-new.png";
                if (!books.getJSONObject(i).getJSONObject("volumeInfo").isNull("imageLinks"))
                    cover = books.getJSONObject(i).getJSONObject("volumeInfo").getJSONObject("imageLinks").getString("smallThumbnail");

                //get categories
                String[] categories = new String[1];
                if (!books.getJSONObject(i).getJSONObject("volumeInfo").isNull("categories")) {
                    JSONArray categories_array = books.getJSONObject(i).getJSONObject("volumeInfo").getJSONArray("categories");
                    categories = new String[categories_array.length()];
                    for (int j=0; j< categories_array.length(); j++) {
                        categories[j] = categories_array.getString(j);
                    }
                } else categories[0] = "-";

                //get price
                Double price;
                String for_sale = books.getJSONObject(i).getJSONObject("saleInfo").getString("saleability");
                if (!books.getJSONObject(i).getJSONObject("saleInfo").isNull("listPrice")) {
                    price = books.getJSONObject(i).getJSONObject("saleInfo").getJSONObject("listPrice").getDouble("amount");
                } else {
                    price=0.0;
                }

                //create new book
                Book a_book = new Book();
                a_book.setIdBook(idBook);
                a_book.setTitle(title);
                a_book.setAuthors(authors);
                a_book.setCover(cover);
                a_book.setDescription(description);
                a_book.setCategories(categories);
                a_book.setPrice(price);

                array_book[i] = a_book;
            }

        } else {
            System.out.println("GET request not worked");
        }

        return array_book;
    }

    @Override
    public Book detailBook(String id) throws Exception {
        Book book = new Book();
        SQLConnect.getConnection();
        String query;
        ResultSet rs;
        int rowCount;
        int i;

        query = "select * from books where idBook = ?";
        SQLConnect.stmt = SQLConnect.connection.prepareStatement(query);
        SQLConnect.stmt.setString(1, id);
        System.out.println(SQLConnect.stmt);
        rs = SQLConnect.stmt.executeQuery();

        while(rs.next()) {
            book.setIdBook(rs.getString("idBook"));
            book.setTitle(rs.getString("title"));
            book.setCover(rs.getString("cover"));
            book.setDescription(rs.getString("description"));
        }

        query = "select name from authornames natural join bookauthors where idBook = ?";
        SQLConnect.stmt = SQLConnect.connection.prepareStatement(query);
        SQLConnect.stmt.setString(1, id);
        rs = SQLConnect.stmt.executeQuery();

        rowCount = 0;
        if(rs.last()) {
            rowCount = rs.getRow();
            rs.beforeFirst();
        }

        String[] authors = new String[rowCount];
        i = 0;

        while(rs.next()) {
            authors[i] = rs.getString("name");
            i++;
        }

        query = "select name from categorynames natural join bookcategories where idBook = ?";
        SQLConnect.stmt = SQLConnect.connection.prepareStatement(query);
        SQLConnect.stmt.setString(1, id);
        rs = SQLConnect.stmt.executeQuery();

        rowCount = 0;
        if(rs.last()) {
            rowCount = rs.getRow();
            rs.beforeFirst();
        }

        String[] categories = new String[rowCount];
        i = 0;

        while(rs.next()) {
            authors[i] = rs.getString("name");
            i++;
        }
        book.setAuthors(authors);
        book.setCategories(authors);

        return book;
    }

    @Override
    public boolean buyBook(String id, int n, String account_number) throws Exception{
        String senderCard = account_number;
        String receiverCard = "123412341234";
        SQLConnect.getConnection();
        String query;
        ResultSet rs;
        double price = 0.0;

        query = "select price from books where idBook = ?";
        SQLConnect.stmt = SQLConnect.connection.prepareStatement(query);
        SQLConnect.stmt.setString(1, id);
        System.out.println(SQLConnect.stmt);
        rs = SQLConnect.stmt.executeQuery();

        while(rs.next()) {
            price = rs.getDouble("price");
        }
        price *= n;

        HttpConnect.sendPost(senderCard, receiverCard, price);
        return true;
    }

    @Override
    public Book recommendBook(String[] category) {
        return new Book();
    }
}