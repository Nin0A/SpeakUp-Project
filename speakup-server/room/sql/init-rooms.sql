CREATE TABLE IF NOT EXISTS rooms (
    room_id UUID PRIMARY KEY,
    name VARCHAR(100),
    owner_id UUID
);

CREATE TABLE IF NOT EXISTS members (
    user_id UUID,
    room_id UUID,
    role ENUM('admin', 'moderator', 'member'),
    PRIMARY KEY (user_id, room_id),
    FOREIGN KEY (room_id) REFERENCES rooms(room_id)
);

CREATE TABLE IF NOT EXISTS room_members (
    room_id UUID,
    user_id UUID,
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (room_id, user_id),
    FOREIGN KEY (room_id) REFERENCES rooms(room_id),
    FOREIGN KEY (user_id) REFERENCES members(user_id)
);
