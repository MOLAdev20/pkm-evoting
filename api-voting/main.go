package main

import (
	"api-voting/routes"
	"api-voting/utility"
)

func main() {

	utility.ConnectDB()
	app := routes.SetupRouter()
	app.Run(":8080")
}
