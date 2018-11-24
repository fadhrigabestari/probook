
package services;

import java.io.IOException;
import javax.jws.WebMethod;
import javax.jws.WebService;
import javax.jws.soap.SOAPBinding;

// import org.json.JSONException;
import models.Book;

@WebService
@SOAPBinding(style = SOAPBinding.Style.RPC)
public interface BookService {

	@WebMethod
	public Book[] searchBook(String title)  throws IOException;
	
	@WebMethod
	public Book detailBook(String id);
	
	@WebMethod
	public boolean buyBook(String id, int n, String account_number);
	
	@WebMethod
	public String recommendBook(String category);
}
