package services;

import javax.xml.ws.Endpoint;

public class SOAPPublisher {
    public static void main(String[] args) {
        Endpoint.publish("http://localhost:8081/api/books", new BookServiceImpl());
    }
}
