package models;

import java.io.Serializable;
import java.util.Arrays;


public class Book implements Serializable {
    private String idBook;
    private String title;
    private String[] authors;
    private String cover;
    private String description;
    private String[] categories;
    private boolean saleability;
    private double price;
    private float rating;


    public String getIdBook() {
        return idBook;
    }

    public void setIdBook(String idBook) {
        this.idBook = idBook;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String[] getAuthors() {
        return Arrays.copyOf(authors, authors.length);
    }

    public void setAuthors(String[] authors) {
        this.authors = Arrays.copyOf(authors, authors.length); 
    }

    public String getCover() {
        return cover;
    }

    public void setCover(String cover) {
        this.cover = cover;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public void setCategories(String[] categories) {
        this.categories = Arrays.copyOf(categories, categories.length);
    }

    public String[] getCategories() {
        return Arrays.copyOf(categories, categories.length);
    }

    public double getPrice() {
        return price;
    }

    public void setPrice(double price) {
        this.price = price;
    }

    public boolean getSaleability() {
        return saleability;
    }

    public void setSaleability(boolean saleability) {
        this.saleability = saleability;
    }

    public float getRating() {
        return rating;
    }

    public void setRating(float rating) {
        this.rating = rating;
    }


   
}
