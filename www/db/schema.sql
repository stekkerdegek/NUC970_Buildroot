CREATE TABLE "users" (
  "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  "name" VARCHAR,
  "key" VARCHAR,
  "remarks" TEXT,
  "last_seen" DATETIME,
  "created_at" DATETIME,
  "updated_at" DATETIME
);

CREATE TABLE "groups" (
  "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  "name" VARCHAR,
  "created_at" DATETIME,
  "updated_at" DATETIME
);

CREATE TABLE "doors" (
  "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  "name" VARCHAR,
  "created_at" DATETIME,
  "updated_at" DATETIME
);

CREATE TABLE "controllers" (
  "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  "name" VARCHAR,
  "created_at" DATETIME,
  "updated_at" DATETIME
);

CREATE TABLE "timezones" (
  "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  "name" VARCHAR,
  "created_at" DATETIME,
  "updated_at" DATETIME
);

CREATE TABLE "events" (
  "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  "title" VARCHAR NOT NULL,
  "created_at" DATETIME,
  "updated_at" DATETIME
);
