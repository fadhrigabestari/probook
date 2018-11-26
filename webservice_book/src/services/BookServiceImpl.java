
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
import utilities.BookServiceUtil;

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
                double price;
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

                int ratingsCount = 0;
                if (!books.getJSONObject(i).getJSONObject("volumeInfo").isNull("ratingsCount")) {
                    ratingsCount=books.getJSONObject(i).getJSONObject("volumeInfo").getInt("ratingsCount");
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
                a_book.setRatingsCount(ratingsCount);

                array_book[i] = a_book;
            }
            
        } else {
            System.out.println("GET request not worked");
        }

        return array_book;
    }
    
    @Override
    public Book detailBook(String id) throws IOException {
        Book detailBook = new Book();
        String getURL = "https://www.googleapis.com/books/v1/volumes/" + id + "?";
        URL url = new URL(getURL);
        HttpURLConnection con = (HttpURLConnection) url.openConnection();
        int responseCode = getConnection(con);
        System.out.println("GET Response Code :: " + responseCode);
        if(responseCode == HttpURLConnection.HTTP_OK) {
            // convert response into json
            JSONObject json = toJSON(con);
            JSONObject volInfo = json.getJSONObject("volumeInfo");
            JSONObject saleInfo = json.getJSONObject("saleInfo");
            // containers
            String title;
            String[] authors = new String[1];
            String cover;
            String description;
            String[] categories = new String[1];
            boolean saleability;
            double price;
            float rating;
            int ratingsCount;

            // get title
            if(!volInfo.isNull("title")) {
                title = volInfo.getString("title");
            } else {
                title = "-";
            }

            // get authors
            if(!volInfo.isNull("authors")) {
                JSONArray arrAuthor = volInfo.getJSONArray("authors");
                authors = new String[arrAuthor.length()];
                int i = 0;
                for(Object author : arrAuthor) {
                    authors[i] = author.toString();
                    i++;
                }
            } else {
                authors = new String[1];
                authors[0] = "-";
            }

            // get cover
            if(!volInfo.isNull("imageLinks")) {
                cover = volInfo.getJSONObject("imageLinks").getString("smallThumbnail");
            } else {
                cover = "-";
            }

            // get description
            if(!volInfo.isNull("description")) {
                description = volInfo.getString("description");
            } else {
                description = "-";
            }

            // get categories
            if(!volInfo.isNull("categories")) {
                JSONArray arrCategories = volInfo.getJSONArray("categories");
                categories = new String[arrCategories.length()];
                int i = 0;
                for(Object category : arrCategories) {
                    categories[i] = category.toString();
                    i++;
                }
            } else {
                categories = new String[1];
                categories[0] = "-";
            }

            // get saleability
            if(saleInfo.getString("saleability").equals("FOR_SALE")) {
                price = saleInfo.getJSONObject("listPrice").getDouble("amount");
                saleability = true;
            } else {
                price = 0.0;
                saleability = false;
            }

            // get average ratings
            if(!volInfo.isNull("averageRating")) {
                rating = volInfo.getFloat("averageRating");
            } else {
                rating = 0;
            }

            // get count ratings
            if(!volInfo.isNull("ratingsCount")) {
                ratingsCount = volInfo.getInt("ratingsCount");
            } else {
                ratingsCount = 0;
            }

            //create new book
            detailBook.setIdBook(id);
            detailBook.setAuthors(authors);
            detailBook.setCategories(categories);
            detailBook.setCover(cover);
            detailBook.setDescription(description);
            detailBook.setPrice(price);
            detailBook.setRating(rating);
            detailBook.setSaleability(saleability);
            detailBook.setTitle(title);
            detailBook.setRatingsCount(ratingsCount);

        } else {
            System.out.println("GET request not worked");
        }
        return detailBook;
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
