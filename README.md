# Notes App

## Project Overview

The Notes App is a simple and effective note management system that allows users to create, edit, and delete notes. It also integrates with a Telegram bot for convenient note management through Telegram.

## Features

- **Add Notes**: Easily add new notes via the web interface or Telegram bot.
- **Edit Notes**: Modify existing notes with a simple user interface or Telegram commands.
- **Delete Notes**: Remove notes using the web interface or Telegram bot.
- **List Notes**: View all your notes directly from Telegram or through the web interface.

## Technologies Used

- **PHP**: Server-side scripting language.
- **MySQL**: Database management system.
- **HTML/CSS**: For the user interface.
- **Telegram Bot API**: For interacting with the application via Telegram.

## Installation

1. **Set Up PHP and MySQL:**
   - Ensure you have PHP and MySQL installed on your server.

2. **Database Configuration:**
   - Create a MySQL database and configure the connection settings in the `src/config.php` file.

3. **Upload Files:**
   - Upload the project files to your web server.

4. **Telegram Bot Setup:**
   - Create a new bot on Telegram and obtain your bot token.
   - Configure the `bot/bot.php` file with your bot token.
   - Deploy the `bot.php` script on a server capable of handling webhook requests from Telegram.

5. **Run the Application:**
   - Access the web interface through `index.php` to start managing your notes.

## Usage

### Web Interface

- **Add a Note:** Use the form on `index.php` to create a new note.
- **Edit a Note:** Click the edit button next to a note to modify its content.
- **Delete a Note:** Click the delete button next to a note to remove it.

### Telegram Bot

- **Add a Note:** Send `/add_note <note_content>` to the bot to add a new note.
- **Edit a Note:** Send `/edit_note <note_id> <new_content>` to update an existing note.
- **Delete a Note:** Send `/delete_note <note_id>` to remove a note.
- **List Notes:** Send `/list_notes` to see all your notes.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request with your improvements or bug fixes.

## Author

[Your Name] - Author

## License

This project is licensed under the [License Name] License. See the `LICENSE` file for details.

## Repository

[GitHub Repository](https://github.com/sob1rdev/notes-app)
