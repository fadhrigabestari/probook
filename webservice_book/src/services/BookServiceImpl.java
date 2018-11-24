
package services;

import java.net.HttpURLConnection;
import java.net.URL;
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
        con.setRequestMethod("GET");
        con.setRequestProperty("User-Agent", "Mozilla/5.0");
        int responseCode = con.getResponseCode();
        System.out.println("GET Response Code :: " + responseCode);
        if (responseCode == HttpURLConnection.HTTP_OK) { 
            // success
            BufferedReader in = new BufferedReader(new InputStreamReader(con.getInputStream()));
            String inputLine;
            StringBuilder response = new StringBuilder();
            while ((inputLine = in.readLine()) != null) {
                response.append(inputLine);
            }
            in.close();
    
            JSONObject json = new JSONObject(response.toString());
            JSONArray books = json.getJSONArray("items");
            int count_books = books.length();
            array_book = new Book[count_books+1];

            for (int i=0; i<count_books; i++) {

                //get title
                String title = books.getJSONObject(i).getJSONObject("volumeInfo").getString("title");
                String idBook = books.getJSONObject(i).getString("id");

                //get description
                String description="-";
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
                } else authors[0] = "-";
                
                
                //get cover
                String cover="-";
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
                
                //get saleability and price
                boolean saleability;
                Double price;
                String for_sale = books.getJSONObject(i).getJSONObject("saleInfo").getString("saleability");
                if (for_sale.equals("NOT_FOR_SALE")) {
                    saleability = false;
                    price= 0.0;
                } else {
                    saleability = true;
                    price = books.getJSONObject(i).getJSONObject("saleInfo").getJSONObject("listPrice").getDouble("amount");
                }

                //get rating
                float rating=0;
                if (!books.getJSONObject(i).getJSONObject("volumeInfo").isNull("averageRating")) {
                    rating=books.getJSONObject(i).getJSONObject("volumeInfo").getFloat("averageRating");
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
                a_book.setSaleability(saleability);
                a_book.setRating(rating);

                array_book[i] = a_book;
            }
            
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
