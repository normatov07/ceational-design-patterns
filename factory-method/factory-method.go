package main

type DB interface {
	connect() error
	execute(query string) any
}

type Mysql struct {
}

func (m *Mysql) connect() error {
	return nil
}
func (m *Mysql) execute(query string) any {
	return nil
}

type DBFactory interface {
	createDB() DB
}

type MysqlFactory struct {
}

func (mf *MysqlFactory) createDB() DB {
	return &Mysql{}
}

func getDB(db DBFactory) DB {
	return db.createDB()
}

func main() {
	var mysqlFactory MysqlFactory
	db := getDB(&mysqlFactory)
	db.connect()
	db.execute("SELECT * FROM users")
}
