--------------------------------------------------------
--  File created - Tuesday-May-07-2024   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Table SBIT2J_USERACCOUNT
--------------------------------------------------------

  CREATE TABLE "SYSTEM"."SBIT2J_USERACCOUNT" 
   (	"USERNAME" VARCHAR2(50 BYTE), 
	"NAME" VARCHAR2(50 BYTE), 
	"USERTYPE" VARCHAR2(1 BYTE), 
	"EMAIL" VARCHAR2(50 BYTE), 
	"CONTACTNUMBER" VARCHAR2(20 BYTE), 
	"ADDRESS" VARCHAR2(150 BYTE), 
	"CITY" VARCHAR2(50 BYTE), 
	"PASSWORD" VARCHAR2(255 BYTE)
   ) PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
REM INSERTING into SYSTEM.SBIT2J_USERACCOUNT
SET DEFINE OFF;
Insert into SYSTEM.SBIT2J_USERACCOUNT (USERNAME,NAME,USERTYPE,EMAIL,CONTACTNUMBER,ADDRESS,CITY,PASSWORD) values ('mara','mara','1','mara','3345','mara','mara','$2y$10$dxWWY9ZKbt1dBfvJjvR7YeiMI6iUqVOtndRIQewfeB1gAzeAtprAu');
Insert into SYSTEM.SBIT2J_USERACCOUNT (USERNAME,NAME,USERTYPE,EMAIL,CONTACTNUMBER,ADDRESS,CITY,PASSWORD) values ('mara2','mara2','2','mara2','mara2','mara2','mara2','$2y$10$eF37ReCKFIPb8w.vw5lUMubM9JUtowQ7uzYtTdN410HYGQddm9nGq');
Insert into SYSTEM.SBIT2J_USERACCOUNT (USERNAME,NAME,USERTYPE,EMAIL,CONTACTNUMBER,ADDRESS,CITY,PASSWORD) values ('wency','Wency Mendoza','1','wency.mendoza@gmail.com','09999999999','#9A Philand Subd. Brgy., ','Quezon City','$2y$10$hlgKcGqf3oAmHZXA9ZpueO4wHmEsMPzploItE9IDpsNUssQF4fV4K');
Insert into SYSTEM.SBIT2J_USERACCOUNT (USERNAME,NAME,USERTYPE,EMAIL,CONTACTNUMBER,ADDRESS,CITY,PASSWORD) values ('mark','Mark Lloren','2','mark.lloren@gmail.com','09999999988','#9A Pasong Tamo Subd. Brgy., ','Quezon City','$2y$10$P1R60dr4LiO/g9d.Ui/N6OXtBZlzl3nxstpJE9KOMQsmH90Pa2.wu');
Insert into SYSTEM.SBIT2J_USERACCOUNT (USERNAME,NAME,USERTYPE,EMAIL,CONTACTNUMBER,ADDRESS,CITY,PASSWORD) values ('almelon2','Jaymerson Almelon','1','almelon.jaymerson@gmail.com','09999988888','#9A Sauyo Subd. Brgy., ','Quezon City','$2y$10$RB5tQAP7zrKeiidavMo94.jCJSp.568ga6OUh0vTr73h64TXWcsya');
Insert into SYSTEM.SBIT2J_USERACCOUNT (USERNAME,NAME,USERTYPE,EMAIL,CONTACTNUMBER,ADDRESS,CITY,PASSWORD) values ('sam','Sam Cesar','1','sam.cesar@gmail.com','09132327437','Blk 60 Lot 36 Northville 2B','Quezon City','$2y$10$9Qpitml/DF/KsYYEmLgpXObBfNJbkJjQLM3bc6uxf9IAm11hlwR56');
Insert into SYSTEM.SBIT2J_USERACCOUNT (USERNAME,NAME,USERTYPE,EMAIL,CONTACTNUMBER,ADDRESS,CITY,PASSWORD) values ('clarence','Clarence Ordejon','1','clarence.ordejon@gmail.com','09059640381','Blk 60 Lot 36 Northville 2B','Quezon City','$2y$10$YT3XV43LKpkJvHXFOOKLbObQjGC8zaFUoctNZhZa2Zmjti4LyMqra');
--------------------------------------------------------
--  DDL for Index USERACCOUNT_PK1
--------------------------------------------------------

  CREATE UNIQUE INDEX "SYSTEM"."USERACCOUNT_PK1" ON "SYSTEM"."SBIT2J_USERACCOUNT" ("USERNAME") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  Constraints for Table SBIT2J_USERACCOUNT
--------------------------------------------------------

  ALTER TABLE "SYSTEM"."SBIT2J_USERACCOUNT" ADD CONSTRAINT "USERACCOUNT_PK" PRIMARY KEY ("USERNAME")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM"  ENABLE;
  ALTER TABLE "SYSTEM"."SBIT2J_USERACCOUNT" MODIFY ("USERNAME" NOT NULL ENABLE);
