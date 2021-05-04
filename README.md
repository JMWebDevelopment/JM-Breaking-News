# JM Client Manager

A plugin to manage all of the clients and their task, invoices and notes.

This will likely evolve over time to include expenses and other items that I sell.

## Installation
Install this plugin like a normal WordPress plugin. To develop the plugin, run `composer install` and `npm install`.

## Changelog
Every change needs to be tracked in the [changelog.md](changelog.md).

## History tracking table

### Clients
```
CREATE TRIGGER wp_jm_cm_clients__ai AFTER INSERT ON wp_jm_cm_clients FOR EACH ROW INSERT INTO wp_jm_cm_clients_history SELECT 'insert', NULL, NOW(), d.*
		    FROM wp_jm_cm_clients AS d WHERE d.id = NEW.id;

			CREATE TRIGGER wp_jm_cm_clients__au AFTER UPDATE ON wp_jm_cm_clients FOR EACH ROW INSERT INTO wp_jm_cm_clients_history SELECT 'update', NULL, NOW(), d.*
		    FROM wp_jm_cm_clients AS d WHERE d.id = NEW.id;

			CREATE TRIGGER wp_jm_cm_clients__bd BEFORE DELETE ON wp_jm_cm_clients FOR EACH ROW INSERT INTO wp_jm_cm_clients_history SELECT 'delete', NULL, NOW(), d.*;

		    CREATE TABLE wp_jm_cm_clients_history (
			  action varchar(8) DEFAULT 'insert',
			  revision int(6) NOT NULL AUTO_INCREMENT,
			  dt_datetime datetime DEFAULT NULL,
			  ID int(11) NOT NULL,
			  business_name text NOT NULL,
		      business_website text NOT NULL,
		      business_address_line_1 text NOT NULL,
		      business_address_line_2 text NOT NULL,
		      business_city text NOT NULL,
		      business_state text NOT NULL,
		      business_zip text NOT NULL,
		      status text NOT NULL,
		      service text NOT NULL
			);
```

### Contacts
```
CREATE TRIGGER wp_jm_cm_contacts__ai AFTER INSERT ON wp_jm_cm_contacts FOR EACH ROW INSERT INTO wp_jm_cm_contacts_history SELECT 'insert', NULL, NOW(), d.*
		    FROM wp_jm_cm_contacts AS d WHERE d.id = NEW.id;

			CREATE TRIGGER wp_jm_cm_contacts__au AFTER UPDATE ON wp_jm_cm_contacts FOR EACH ROW INSERT INTO wp_jm_cm_contacts_history SELECT 'update', NULL, NOW(), d.*
		    FROM wp_jm_cm_contacts AS d WHERE d.id = NEW.id;

			CREATE TRIGGER wp_jm_cm_contacts__bd BEFORE DELETE ON wp_jm_cm_contacts FOR EACH ROW INSERT INTO wp_jm_cm_contacts_history SELECT 'delete', NULL, NOW(), d.*;

		    CREATE TABLE wp_jm_cm_contacts_history (
			  action varchar(8) DEFAULT 'insert',
			  revision int(6) NOT NULL AUTO_INCREMENT,
			  dt_datetime datetime DEFAULT NULL,
			  ID int(11) NOT NULL,
			  contact_name text NOT NULL,
		      business_ids text NOT NULL,
			  contact_email text NOT NULL,
		      contact_phone text NOT NULL,
		      contact_address_line_1 text NOT NULL,
		      contact_address_line_2 text NOT NULL,
		      contact_city text NOT NULL,
		      contact_state text NOT NULL,
		      contact_zip text NOT NULL
			);
```

### Clients and Contacts Intersect
```
CREATE TRIGGER wp_jm_cm_client_contact_intersect__ai AFTER INSERT ON wp_jm_cm_client_contact_intersect FOR EACH ROW INSERT INTO wp_jm_cm_client_contact_intersect_history SELECT 'insert', NULL, NOW(), d.*
		    FROM wp_jm_cm_client_contact_intersect AS d WHERE d.id = NEW.id;

			CREATE TRIGGER wp_jm_cm_client_contact_intersect__au AFTER UPDATE ON wp_jm_cm_client_contact_intersect FOR EACH ROW INSERT INTO wp_jm_cm_client_contact_intersect_history SELECT 'update', NULL, NOW(), d.*
		    FROM wp_jm_cm_client_contact_intersect AS d WHERE d.id = NEW.id;

			CREATE TRIGGER wp_jm_cm_client_contact_intersect__bd BEFORE DELETE ON wp_jm_cm_client_contact_intersect FOR EACH ROW INSERT INTO wp_jm_cm_client_contact_intersect_history SELECT 'delete', NULL, NOW(), d.*;

		    CREATE TABLE wp_jm_cm_client_contact_intersect_history (
			  action varchar(8) DEFAULT 'insert',
			  revision int(6) NOT NULL AUTO_INCREMENT,
			  dt_datetime datetime DEFAULT NULL,
			  ID int(11) NOT NULL,
			  contact_id INTEGER NOT NULL,
		      business_id INTEGER NOT NULL
			);
```

### Invoices
```
CREATE TRIGGER wp_jm_cm_invoices__ai AFTER INSERT ON wp_jm_cm_invoices FOR EACH ROW INSERT INTO wp_jm_cm_invoices_history SELECT 'insert', NULL, NOW(), d.*
		    FROM wp_jm_cm_invoices AS d WHERE d.id = NEW.id;

			CREATE TRIGGER wp_jm_cm_invoices__au AFTER UPDATE ON wp_jm_cm_invoices FOR EACH ROW INSERT INTO wp_jm_cm_invoices_history SELECT 'update', NULL, NOW(), d.*
		    FROM wp_jm_cm_invoices AS d WHERE d.id = NEW.id;

			CREATE TRIGGER wp_jm_cm_invoices__bd BEFORE DELETE ON wp_jm_cm_invoices FOR EACH ROW INSERT INTO wp_jm_cm_invoices_history SELECT 'delete', NULL, NOW(), d.*;

		    CREATE TABLE wp_jm_cm_invoices_history (
			  action varchar(8) DEFAULT 'insert',
			  revision int(6) NOT NULL AUTO_INCREMENT,
			  dt_datetime datetime DEFAULT NULL,
			  ID int(11) NOT NULL,
			  business_id INTEGER NOT NULL,
		      invoice_amount float NOT NULL,
			  invoice_due_date DATETIME NOT NULL,
			  invoice_date_paid DATETIME NOT NULL,
		      invoice_date_sent DATETIME NOT NULL,
		      invoice_status text NOT NULL,
		      invoice_items text NOT NULL
			);
```

### Labels
```
CREATE TRIGGER wp_jm_cm_labels__ai AFTER INSERT ON wp_jm_cm_labels FOR EACH ROW INSERT INTO wp_jm_cm_labels_history SELECT 'insert', NULL, NOW(), d.*
		    FROM wp_jm_cm_labels AS d WHERE d.id = NEW.id;

			CREATE TRIGGER wp_jm_cm_labels__au AFTER UPDATE ON wp_jm_cm_labels FOR EACH ROW INSERT INTO wp_jm_cm_labels_history SELECT 'update', NULL, NOW(), d.*
		    FROM wp_jm_cm_labels AS d WHERE d.id = NEW.id;

			CREATE TRIGGER wp_jm_cm_labels__bd BEFORE DELETE ON wp_jm_cm_labels FOR EACH ROW INSERT INTO wp_jm_cm_labels_history SELECT 'delete', NULL, NOW(), d.*;

		    CREATE TABLE wp_jm_cm_labels_history (
			  action varchar(8) DEFAULT 'insert',
			  revision int(6) NOT NULL AUTO_INCREMENT,
			  dt_datetime datetime DEFAULT NULL,
			  ID int(11) NOT NULL,
			  label_name text NOT NULL,
		      label_color text NOT NULL,
			  label_background_color text NOT NULL,
			  task_description text NOT NULL
			);
```

### Notes
```
CREATE TRIGGER wp_jm_cm_notes__ai AFTER INSERT ON wp_jm_cm_notes FOR EACH ROW INSERT INTO wp_jm_cm_notes_history SELECT 'insert', NULL, NOW(), d.*
		    FROM wp_jm_cm_notes AS d WHERE d.id = NEW.id;

			CREATE TRIGGER wp_jm_cm_notes__au AFTER UPDATE ON wp_jm_cm_notes FOR EACH ROW INSERT INTO wp_jm_cm_notes_history SELECT 'update', NULL, NOW(), d.*
		    FROM wp_jm_cm_notes AS d WHERE d.id = NEW.id;

			CREATE TRIGGER wp_jm_cm_notes__bd BEFORE DELETE ON wp_jm_cm_notes FOR EACH ROW INSERT INTO wp_jm_cm_notes_history SELECT 'delete', NULL, NOW(), d.*;

		    CREATE TABLE wp_jm_cm_notes_history (
			  action varchar(8) DEFAULT 'insert',
			  revision int(6) NOT NULL AUTO_INCREMENT,
			  dt_datetime datetime DEFAULT NULL,
			  ID int(11) NOT NULL,
			  business_id INTEGER NOT NULL,
		      note_date DATETIME NOT NULL,
			  note text NOT NULL
			);
```

### Tasks
```
CREATE TRIGGER wp_jm_cm_tasks__ai AFTER INSERT ON wp_jm_cm_tasks FOR EACH ROW INSERT INTO wp_jm_cm_tasks_history SELECT 'insert', NULL, NOW(), d.*
		    FROM wp_jm_cm_tasks AS d WHERE d.id = NEW.id;

			CREATE TRIGGER wp_jm_cm_tasks__au AFTER UPDATE ON wp_jm_cm_tasks FOR EACH ROW INSERT INTO wp_jm_cm_tasks_history SELECT 'update', NULL, NOW(), d.*
		    FROM wp_jm_cm_tasks AS d WHERE d.id = NEW.id;

			CREATE TRIGGER wp_jm_cm_tasks__bd BEFORE DELETE ON wp_jm_cm_tasks FOR EACH ROW INSERT INTO wp_jm_cm_tasks_history SELECT 'delete', NULL, NOW(), d.*;

		    CREATE TABLE wp_jm_cm_tasks_history (
			  action varchar(8) DEFAULT 'insert',
			  revision int(6) NOT NULL AUTO_INCREMENT,
			  dt_datetime datetime DEFAULT NULL,
			  ID int(11) NOT NULL,
			  business_id INTEGER NOT NULL,
		      task_title text NOT NULL,
			  task_description text NOT NULL,
		      task_labels text NOT NULL,
		      task_status text NOT NULL,
		      task_hours float NOT NULL,
		      task_rate float NOT NULL,
		      task_price float NOT NULL,
		      task_due_date DATETIME NOT NULL,
			  task_date_complete DATETIME NOT NULL
			);
```

### Task Comments
```
CREATE TRIGGER wp_jm_cm_task_comments__ai AFTER INSERT ON wp_jm_cm_task_comments FOR EACH ROW INSERT INTO wp_jm_cm_task_comments_history SELECT 'insert', NULL, NOW(), d.*
		    FROM wp_jm_cm_task_comments AS d WHERE d.id = NEW.id;

			CREATE TRIGGER wp_jm_cm_task_comments__au AFTER UPDATE ON wp_jm_cm_task_comments FOR EACH ROW INSERT INTO wp_jm_cm_task_comments_history SELECT 'update', NULL, NOW(), d.*
		    FROM wp_jm_cm_task_comments AS d WHERE d.id = NEW.id;

			CREATE TRIGGER wp_jm_cm_task_comments__bd BEFORE DELETE ON wp_jm_cm_task_comments FOR EACH ROW INSERT INTO wp_jm_cm_task_comments_history SELECT 'delete', NULL, NOW(), d.*;

		    CREATE TABLE wp_jm_cm_task_comments_history (
			  action varchar(8) DEFAULT 'insert',
			  revision int(6) NOT NULL AUTO_INCREMENT,
			  dt_datetime datetime DEFAULT NULL,
			  ID int(11) NOT NULL,
			  task_id INTEGER NOT NULL,
		      comment text NOT NULL,
			  comment_type text NOT NULL,
		      comment_date DATETIME NOT NULL,
			  comment_hours text NOT NULL
			);
```
