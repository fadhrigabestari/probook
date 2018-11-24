
package services;

import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Set;
import java.io.IOException;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import javax.jws.WebService;

import probook.Book;

@WebService(endpointInterface = "probook.BookService")  
public class BookServiceImpl implements BookService {

    
    @Override
    public Book[] searchBook(String title) throws IOException {
        Book[] array_book = new Book[1];
        String get_url = "https://www.googleapis.com/books/v1/volumes?q=" + title;
        System.out.println(get_url);
        URL url = new URL(get_url);
        HttpURLConnection con = (HttpURLConnection) url.openConnection();   
        con.setRequestMethod("GET");
        con.setRequestProperty("User-Agent", "Mozilla/5.0");
        int responseCode = con.getResponseCode();
        System.out.println("GET Response Code :: " + responseCode);
        if (responseCode == HttpURLConnection.HTTP_OK) { 
            // success
            BufferedReader in = new BufferedReader(new InputStreamReader(con.getInputStream()));
            String inputLine;
            StringBuffer response = new StringBuffer();
            while ((inputLine = in.readLine()) != null) {
                response.append(inputLine);
            }
            in.close();
            // print result
            System.out.println(response.toString());
        } else {
            System.out.println("GET request not worked");
        }
        return array_book;
    }
    
    @Override
    public Book detailBook(String id) {
        return (new Book());
    }
    
    @Override
    public boolean buyBook(String id, int n, String account_number) {
        return true;
    }
    
    @Override
    public String recommendBook(String category) {
        return "test";
    }

}
