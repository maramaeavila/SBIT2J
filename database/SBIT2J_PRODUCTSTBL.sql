--------------------------------------------------------
--  File created - Thursday-May-09-2024   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Table SBIT2J_PRODUCTSTBL
--------------------------------------------------------

  CREATE TABLE "SYSTEM"."SBIT2J_PRODUCTSTBL" 
   (	"P_ID" VARCHAR2(255 BYTE), 
	"P_NAME" VARCHAR2(100 BYTE), 
	"P_CATGENDER" VARCHAR2(108 BYTE), 
	"P_CATEGORY" VARCHAR2(108 BYTE), 
	"P_PRICE" NUMBER(20,2), 
	"P_SIZE" VARCHAR2(10 BYTE), 
	"P_IMAGE" VARCHAR2(255 BYTE), 
	"P_DESCRIPTION" VARCHAR2(255 BYTE), 
	"SMALLQTY" NUMBER(38,0), 
	"MEDIUMQTY" NUMBER(38,0), 
	"LARGEQTY" NUMBER(38,0)
   ) PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
REM INSERTING into SYSTEM.SBIT2J_PRODUCTSTBL
SET DEFINE OFF;
Insert into SYSTEM.SBIT2J_PRODUCTSTBL (P_ID,P_NAME,P_CATGENDER,P_CATEGORY,P_PRICE,P_SIZE,P_IMAGE,P_DESCRIPTION,SMALLQTY,MEDIUMQTY,LARGEQTY) values ('1002','Cream Jacket','Men','Jackets',599,'Small','WINDB2.png','Cream Jacket with colar',7,7,7);
Insert into SYSTEM.SBIT2J_PRODUCTSTBL (P_ID,P_NAME,P_CATGENDER,P_CATEGORY,P_PRICE,P_SIZE,P_IMAGE,P_DESCRIPTION,SMALLQTY,MEDIUMQTY,LARGEQTY) values ('1003','Red Jacket','Men','Jackets',599,'Small','WINDB3.png','Red Jacket with colar',3,6,6);
Insert into SYSTEM.SBIT2J_PRODUCTSTBL (P_ID,P_NAME,P_CATGENDER,P_CATEGORY,P_PRICE,P_SIZE,P_IMAGE,P_DESCRIPTION,SMALLQTY,MEDIUMQTY,LARGEQTY) values ('1001','Blue Cold','Men','Jackets',599,'Small','WINDB1.png','Blue Hoodie Jacket',5,5,5);
Insert into SYSTEM.SBIT2J_PRODUCTSTBL (P_ID,P_NAME,P_CATGENDER,P_CATEGORY,P_PRICE,P_SIZE,P_IMAGE,P_DESCRIPTION,SMALLQTY,MEDIUMQTY,LARGEQTY) values ('1004','Pink','Women','Jackets',599,'Small','WINDB22.png','Pink puff',5,5,5);
Insert into SYSTEM.SBIT2J_PRODUCTSTBL (P_ID,P_NAME,P_CATGENDER,P_CATEGORY,P_PRICE,P_SIZE,P_IMAGE,P_DESCRIPTION,SMALLQTY,MEDIUMQTY,LARGEQTY) values ('1005','Pink','Women','Jackets',599,'Medium','WINDB22.png','Pink Puff',5,5,5);
--------------------------------------------------------
--  DDL for Index SYS_C007143
--------------------------------------------------------

  CREATE UNIQUE INDEX "SYSTEM"."SYS_C007143" ON "SYSTEM"."SBIT2J_PRODUCTSTBL" ("P_ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  Constraints for Table SBIT2J_PRODUCTSTBL
--------------------------------------------------------

  ALTER TABLE "SYSTEM"."SBIT2J_PRODUCTSTBL" ADD PRIMARY KEY ("P_ID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM"  ENABLE;
