-- Créer le keyspace
CREATE KEYSPACE IF NOT EXISTS message WITH replication = {'class': 'SimpleStrategy', 'replication_factor': 3};

-- Se connecter au keyspace "message"
USE message;

-- Créer la table "messages"
CREATE TABLE IF NOT EXISTS messages (
    message_id UUID PRIMARY KEY,
    room_id INT,
    user_id UUID,
    content TEXT,
    attachments LIST<TEXT>,
    created_at TIMESTAMP
);
