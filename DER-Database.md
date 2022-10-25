tbUsers
- id (PK, AI, NOTNULL)
- firstName (varchar[255])
- lastName (varchar[255])
- email (varchar[255])
- password (varchar[255])
- avatar (varchar[255])
- biografy (text)
- token (varchar[255])

tbMovies
- id (PK, AI, NOTNULL)
- title (varchar[255])
- description (text)
- avatar (varchar[255])
- trailer (varchar[255])
- category (varchar[255])
- fk_usersId

tbComments
- id (PK, AI, NOTNULL)
- rating (int)
- review (text)
- fk_usersId
- fk_moviesId