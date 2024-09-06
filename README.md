Social Media Application

    This project is a basic social media application built using Laravel. It allows users to register, create posts, follow/unfollow other users, and like/unlike posts. The application also features a user profile page displaying the user's posts, followers, and following count.

    composer create-project laravel/laravel="5.1.*" SocialMediaApp

Features

    User Authentication: Users can register, log in, and manage their profiles.

    Post Creation: Users can create, edit, and delete posts with images and text content.

    Follow System: Users can follow and unfollow other users.

    Likes: Users can like and unlike posts.

    User Profile: A profile page that displays a grid of the user's posts along with follower and following counts.

Libraries Used

    Laravel: PHP framework for building the application.

    Bootstrap: For responsive UI components.

    Font Awesome / Bootstrap Icons: For like/unlike heart icons and other UI elements.

    Laravel Breeze: For authentication scaffolding.

Database Structure

    Tables

        Users: Contains user information such as id, name, email, and profile_image.

        Posts: Contains posts created by users, with fields such as id, user_id, content, image, and timestamps.

        Followers: Manages the follow relationships between users with user_id and follower_id.

        Likes: Tracks likes on posts with fields like id, post_id, user_id, and timestamps.

    Relationships
        User: Has many posts, has many followers and followings through the followers table, and has many likes.

        Post: Belongs to a user and has many likes.

Installation
    Run composer install to install PHP dependencies.

    Configure your .env file for the database connection.

    Run php artisan migrate to create the database tables.

    Start the server with php artisan serve.
    
Usage
After registration, users are redirected to the posts.index page where they can view and interact with posts.
Users can follow or unfollow other users and view their profiles.
Posts are displayed in a grid view on user profiles.
