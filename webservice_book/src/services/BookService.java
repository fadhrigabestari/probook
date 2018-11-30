
package services;

import java.io.IOException;
import java.net.HttpURLConnection;
import javax.jws.WebMethod;
import javax.jws.WebService;
import javax.jws.soap.SOAPBinding;

import org.json.JSONException;
import org.json.JSONObject;
import org.json.JSONArray;
import models.Book;

@WebService
@SOAPBinding(style = SOAPBinding.Style.RPC)
public interface BookService {
	@WebMethod
	public Book[] searchBook(String title_input)  throws Exception, JSONException;
	
	@WebMethod
	public Book detailBook(String id) throws Exception;

	@WebMethod
	public boolean buyBook(String id, int n, String account_number) throws Exception;

	@WebMethod
	public Book[] recommendBook(String category) throws Exception;
}
