
CREATE TABLE `book_info` (
  `subject` varchar(55) NOT NULL,
  `book` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`book`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `book_req` (
  `id` int(11) NOT NULL,
  `book` varchar(50) NOT NULL,
  `credits` int(11) NOT NULL,
  `requested_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`,`book`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `book` varchar(50) NOT NULL,
  `location` varchar(55) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT 0,
  `status` varchar(5) DEFAULT 'p',
  `requested_at` datetime NOT NULL DEFAULT current_timestamp(),
  `delivered_at` datetime DEFAULT current_timestamp(),
  `delivered_by` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`,`book`,`requested_at`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `location` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `credits` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `collectors` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `location` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `deliveryperson` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `location` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `collection` (
  `id` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `book` varchar(50) NOT NULL,
  `location` varchar(55) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT 0,
  `status` varchar(5) DEFAULT 'p',
  `posted_at` datetime NOT NULL DEFAULT current_timestamp(),
  `collected_at` datetime DEFAULT current_timestamp(),
  `collected_by` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`,`book`,`posted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `donation_interest` (
  `id` int(11) NOT NULL,
  `subject` varchar(55) NOT NULL,
  `book` varchar(55) NOT NULL,
  `location` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `posted_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`,`book`,`posted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*paste the following in sql section of php myadmin */

delimiter |

CREATE EVENT finalreq
    ON SCHEDULE
      EVERY 1 DAY
      STARTS (TIMESTAMP(CURRENT_DATE) + INTERVAL 1 MINUTE) 
     
    DO
    BEGIN
  INSERT  INTO delivery(id,book,location,rank,requested_at) 
Select X.id,X.book,X.location,ROW_NUMBER() OVER (PARTITION BY X.location
              ORDER BY X.id,X.book) as token,X.requested_at
         from ((
select b1.book,b1.id,u.location,b1.requested_at,(select count(*)
from book_req as b
where b.book= b1.book and (b.credits> b1.credits or( b.credits= b1.credits and b.requested_at<b1.requested_at)))+1 as rank,i.quantity
from book_req as b1,book_info as i,users as u where b1.book=i.book and b1.id=u.id) as X)
where X.rank<=X.quantity-(select count(*) from delivery where book=X.book and status='p')
order by location,id,book;
DELETE FROM book_req where (book_req.id,book_req.book,book_req.requested_at) IN (SELECT X.id,X.book,X.requested_at from delivery as X where X.status='p');

END |
delimiter;




/*similarly this*/


delimiter |

CREATE EVENT finalcollection
    ON SCHEDULE
      EVERY 1 DAY
      STARTS (TIMESTAMP(CURRENT_DATE) + INTERVAL 1 MINUTE) 
     
    DO
BEGIN 

INSERT INTO collection(id,subject,book,location,quantity,rank)
select b1.id,b1.subject,b1.book,b1.location,b1.quantity,ROW_NUMBER()OVER(PARTITION BY b1.location ORDER BY b1.id) as token
from donation_interest as b1;
delete from donation_interest;

	END |
delimiter;







