package com.javaejemplo.demo;

import jakarta.servlet.http.*;
import jakarta.servlet.annotation.*;

@WebServlet(name = "helloServlet", value = "/hello-servlet")
public class HelloServlet extends HttpServlet {
    public void doGet(HttpServletRequest request, HttpServletResponse response) {
        response.setContentType("text/html");

        try {
            response.getWriter().println("<h1>Hello, World!</h1>");
        } catch (Exception e) {
            e.printStackTrace();
        }

    }

    public void destroy() {
    }
}