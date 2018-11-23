package services;

import models.Book;

import javax.jws.WebService;
import java.util.HashMap;
import java.util.Map;
import java.util.Set;

@WebService(endpointInterface = "services.BookService")
public class BookServiceImpl implements BookService {
    private static Map<String, Book> books = new HashMap<String, Book>();

    @Override
    public boolean addBook(Book b) {
        if(books.get(b.getIdBook()) == null) return false;
        books.put(b.getIdBook(), b);
        return true;
    }

    @Override
    public boolean deleteBook(String idBook) {
        if(books.get(idBook) == null) return false;
        books.remove(idBook);
        return true;
    }

    @Override
    public Book getBook(String idBook) {
        return books.get(idBook);
    }

    @Override
    public Book[] getAllBook() {
        Set<String> ids = books.keySet();
        Book[] b = new Book[ids.size()];
        int i = 0;
        for(String id : ids) {
            b[i] = books.get(id);
            i++;
        }
        return b;
    }
}
