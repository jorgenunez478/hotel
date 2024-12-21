CREATE TABLE public.hotels (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) UNIQUE NOT NULL,
    tax_id VARCHAR(255) UNIQUE NOT NULL,
    city VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    nit VARCHAR(255) UNIQUE NOT NULL,
    max_rooms INTEGER NOT NULL,
    created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE public.rooms (
    id SERIAL PRIMARY KEY,
    hotel_id INTEGER NOT NULL,
    type VARCHAR(255) NOT NULL CHECK (type IN ('Estándar', 'Junior', 'Suite')),
    accommodation VARCHAR(255) NOT NULL CHECK (accommodation IN ('Sencilla', 'Doble', 'Triple', 'Cuádruple')),
    quantity INTEGER NOT NULL,
    created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (hotel_id) REFERENCES public.hotels (id) ON DELETE CASCADE
);

INSERT INTO public.hotels (name, tax_id, city, address, nit, max_rooms, created_at, updated_at)
VALUES ('Hotel Example', '123456789', 'Example City', '123 Example Street', '987654321', 42, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO public.rooms (hotel_id, type, accommodation, quantity, created_at, updated_at)
VALUES 
((SELECT id FROM public.hotels WHERE name = 'Hotel Example'), 'Estándar', 'Sencilla', 25, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
((SELECT id FROM public.hotels WHERE name = 'Hotel Example'), 'Junior', 'Triple', 12, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
((SELECT id FROM public.hotels WHERE name = 'Hotel Example'), 'Estándar', 'Doble', 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);