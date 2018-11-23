package services;

import models.Book;

import javax.jws.WebMethod;
import javax.jws.WebService;
import javax.jws.soap.SOAPBinding;

@WebService
@SOAPBinding(style = SOAPBinding.Style.RPC)
public interface BookService {
    @WebMethod
    public boolean addBook(Book b);

    @WebMethod
    public boolean deleteBook(String idBook);

    @WebMethod
    public Book getBook(String idBook);

    @WebMethod
    public Book[] getAllBook();
}
