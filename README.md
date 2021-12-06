Contact list. 
Create, edit and delete contacts.
Link to call from pc or mobile.
Link to send email.
100% responsive.


-- Datatable structure `contacts`

CREATE TABLE `contacts` (
  `name` varchar(30) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `prefix` varchar(3) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id` int(30) NOT NULL
)

ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `contacts`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;



