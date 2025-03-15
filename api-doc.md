# API - Documentation

## Table of Contents

1. [Description](#description)
2. [Home Action](#home-action)
   - [GET /speakup](#get-speakup)
3. [Authentication](#authentication)
   - [POST /register](#post-register)
   - [POST /signin](#post-signin)
   - [GET /validate](#get-validate)

---

## Description

Welcome to the SpeakUp API documentation. This API provides functionalities for user authentication and home-related actions.

---

## Configuration

The API is currently running on `localhost` at port `8081`. Make sure your development environment is configured to access the API at `http://localhost:8081`.

---

## Home Action

### `GET /speakup`

Retrieves a welcome message.

- **URL**: `/speakup`
- **Method**: `GET`
- **Description**: This endpoint is used to retrieve a welcome message.
- **Response**:
  - `200 OK`: Welcome message

---

## Authentication

### `POST /register`

Registers a new user.

- **URL**: `/register`
- **Method**: `POST`
- **Description**: This endpoint allows new users to register by providing necessary details.
- **Data**:
  ```json
  {
    "email": "<email>",
    "password": "<password>"
  }
  ```
- **Response**:
  - `201 Created`: User registered successfully

### `POST /signin`

Authenticates a user and provides a JWT token.

- **URL**: `/signin`
- **Method**: `POST`
- **Description**: This endpoint allows users to sign in by providing necessary details.
- **Data**:
  ```json
  {
    "email": "<email>",
    "password": "<password>"
  }
  ```
- **Response**:
  - `200 OK`: JWT Token

### `GET /validate`

Validates the user's authentication token.

- **URL**: `/validate`
- **Method**: `GET`
- **Description**: This endpoint checks the validity of the user's authentication token.
- **Middleware**: `AuthMiddleware`
- **Headers**:
  - `Authorization: Bearer <token>`
- **Response**:
  - `200 OK`: Token is valid
  - `401 Unauthorized`: Invalid or expired token