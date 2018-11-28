package utilities;

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.nio.charset.StandardCharsets;

public class HttpConnect {

    // HTTP POST request
    public static void sendPost(String senderCard, String receiverCard, int amount) throws Exception {
        String request = "http://localhost:8082/api/bank/transfer";
        String urlParameters = "senderCard=" + senderCard +
                "&receiverCard=" + receiverCard +
                "&amount=" + amount;

        URL url = new URL(request);
        HttpURLConnection connection = (HttpURLConnection) url.openConnection();

        //add reuqest header
        connection.setRequestMethod("POST");
        connection.setRequestProperty("Content-Type", "application/x-www-form-urlencoded;charset=UTF-8");
        connection.setRequestProperty("Accept-Charset", urlParameters);

        // Send post request
        connection.setDoOutput(true);
        try(OutputStream output = connection.getOutputStream()) {
            output.write(urlParameters.getBytes(StandardCharsets.UTF_8));
        } catch(Exception e) {
            System.out.print(e.getMessage());
        }

        int responseCode = connection.getResponseCode();
        System.out.println("\nSending 'POST' request to URL : " + url);
        System.out.println("Post parameters : " + urlParameters);
        System.out.println("Response Code : " + responseCode);

        BufferedReader in = new BufferedReader(
                new InputStreamReader(connection.getInputStream()));
        String inputLine;
        StringBuffer response = new StringBuffer();

        while ((inputLine = in.readLine()) != null) {
            response.append(inputLine);
        }
        in.close();

        //print result
        System.out.println(response.toString());
    }

}