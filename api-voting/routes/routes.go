package routes

import (
	"api-voting/handlers"

	"github.com/gin-gonic/gin"
)

func SetupRouter() *gin.Engine {
	r := gin.Default()

	candidateRoutes := r.Group("/candidates")
	{
		candidateRoutes.GET("/", handlers.GetAllCandidate)
		candidateRoutes.POST("/", handlers.InsertCandidate)
	}

	participantRoutes := r.Group("/participant")
	{
		participantRoutes.GET("/", handlers.GetAllParticipants)
		participantRoutes.POST("/", handlers.CreateParticipant)
	}

	votingRoutes := r.Group("/voting")
	{
		votingRoutes.POST("/", handlers.InsertVoting)
	}

	authRoutes := r.Group("/auth")
	{
		authRoutes.GET("/", handlers.CreateToken)
		authRoutes.GET("/verify-token", handlers.VerifyToken)
	}

	return r
}
