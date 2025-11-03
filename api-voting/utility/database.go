package utility

import (
	"api-voting/models"
	"fmt"

	"gorm.io/driver/mysql"
	"gorm.io/gorm"
)

var DB *gorm.DB

func ConnectDB() {
	dsn := "root:admin@24434@tcp(127.0.0.1:3306)/evoting?charset=utf8mb4&parseTime=True&loc=Local"

	db, err := gorm.Open(mysql.Open(dsn), &gorm.Config{})

	if err != nil {
		fmt.Println(err)
		panic("Failed to connect to database")
	}

	// migration
	var candidate models.Candidate
	if err := db.AutoMigrate(&candidate); err != nil {
		fmt.Println("Migrasi gagal dijalankan:", err)
	}

	DB = db
}
