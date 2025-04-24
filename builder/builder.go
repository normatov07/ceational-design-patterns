package main

type Builder interface {
	Table(string)
	Select(...string)
	Where(string, string, string)
	Limit(int, int)
	OrderBy(string, string)
}

type Mysqlbuilder struct {
	table     string
	selects   []string
	wheres    []string
	limit     string
	orderBy   string
	direction string
}

func (b *Mysqlbuilder) Table(table string) {
	b.table = table
}

func (b *Mysqlbuilder) Select(selects ...string) {
	b.selects = selects
}

func (b *Mysqlbuilder) Where(field string, operator string, value string) {
	b.wheres = append(b.wheres, field+" "+operator+" "+value)
}

func (b *Mysqlbuilder) Limit(offset int, limit int) {
	b.limit = string(offset) + "," + string(limit)
}

func (b *Mysqlbuilder) OrderBy(field string, direction string) {
	b.orderBy = field
	b.direction = direction
}

func (b *Mysqlbuilder) GetSQL() string {
	sql := "SELECT "
	if len(b.selects) > 0 {
		for i, s := range b.selects {
			sql += s
			if i < len(b.selects)-1 {
				sql += ", "
			}
		}
	} else {
		sql += "*"
	}

	sql += " FROM " + b.table

	if len(b.wheres) > 0 {
		sql += " WHERE "
		for i, w := range b.wheres {
			sql += w
			if i < len(b.wheres)-1 {
				sql += " AND "
			}
		}
	}

	if b.orderBy != "" {
		sql += " ORDER BY " + b.orderBy + " " + b.direction
	}

	if b.limit != "" {
		sql += " LIMIT " + b.limit
	}

	return sql
}

// Client impelementation

// This is very basic implementation you can implement director struct and call it on client method
// and it gives more simplicity

func main() {
	var builder Builder

	builder = &Mysqlbuilder{}
	builder.Table("users")
	builder.Select("id", "name", "email")
	builder.Where("id", "=", "1")
	builder.Limit(0, 10)
	builder.OrderBy("id", "asc")

}
