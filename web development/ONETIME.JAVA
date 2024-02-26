import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.util.*;

public class OTPServlet extends HttpServlet {
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        int length = 6;
        String otp = generateOTP(length);
        response.setContentType("text/plain");
        response.getWriter().write(otp);
    }

    private String generateOTP(int length) {
        String numbers = "0123456789";
        Random rndm_method = new Random();
        char[] otp = new char[length];
        for (int i = 0; i < length; i++) {
            otp[i] = numbers.charAt(rndm_method.nextInt(numbers.length()));
        }
        return new String(otp);
    }
}
