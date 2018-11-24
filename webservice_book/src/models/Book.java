package models;

import java.io.Serializable;

public class Book implements Serializable {
    private String idBook;
    private String title;
    private String author;
    private String cover;
    private String description;
    private String category;
    private boolean saleability;
    private double price;

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

    public String getAuthor() {
        return author;
    }

    public void setAuthor(String author) {
        this.author = author;
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

    public void setCategory(String category) {
        this.category = category;
    }

    public String getCategory() {
        return category;
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

    public void setPrice(boolean saleability) {
        this.saleability = saleability;
    }


   
}
