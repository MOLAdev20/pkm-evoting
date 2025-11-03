package routes

import (
	"api-voting/handlers"

	"github.com/gin-gonic/gin"
)

func SetupRouter() *gin.Engine {
	r := gin.Default()

	candidates := r.Group("/candidates")

	candidates.GET("/", handlers.GetCandidates)
	candidates.POST("/", handlers.InsertCandidate)

	return r
}
