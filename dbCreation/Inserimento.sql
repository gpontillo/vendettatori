INSERT INTO categoria(id_categoria, descrizione_categoria)
       VALUES(1,
              'Politica'
              );

INSERT INTO categoria(id_categoria, descrizione_categoria)
       VALUES(2,
              'Sport');

INSERT INTO notizia(id, link, descrizione_notizia, tipo_categoria, indice_attendibilita, data_pubblicazione, data_accaduto, coinvolgimento)
       VALUES(1,
             'https://www.rainews.it/maratona/2023/05/guerra-in-ucraina-la-cronaca-minuto-per-minuto-giorno-446-9109119e-9ffd-49e5-abcc-7a69b392463d.html',
              'Notizia su guerra in ucraina',
              2,
              70,
              '2023-05-15',
              '2023-05-14',
              'Volodymir Zelensky');

INSERT INTO notizia(id, link, descrizione_notizia, tipo_categoria, indice_attendibilita, data_pubblicazione, data_accaduto, coinvolgimento)
       VALUES(3,
             'https://www.youtube.com/watch?v=tnM_qznnsLw',
              'Video satira',
              2,
              70,
              '2023-05-15',
              '2023-05-14',
              'Autogol');

INSERT INTO notizia(id, link, descrizione_notizia, tipo_categoria, indice_attendibilita, data_pubblicazione, data_accaduto, coinvolgimento)
       VALUES(2,
            'https://www.youtube.com/watch?v=vQkzk0GRhHM',
            'Video di calcio',
             1,
             30,
             '2023-05-14',
             '2023-05-14',
             'Seria A Tim');
