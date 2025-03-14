CREATE TABLE IF NOT EXISTS users (
    user_id UUID PRIMARY KEY,
    username VARCHAR(50),
    avatar_url TEXT,
    status ENUM('online', 'offline', 'away'),
    audio_input_device TEXT,
    audio_output_device TEXT,
    audio_microphone TEXT,
    audio_volume INT
);
