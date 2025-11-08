package handlers

import (
	"api-voting/models"
	"api-voting/utility"
	"net/http"

	"github.com/gin-gonic/gin"
)

func CreateParticipant(ctx *gin.Context) {
	var participant models.Participant

	// Catch post request
	if err := ctx.ShouldBindJSON(&participant); err != nil {
		ctx.JSON(http.StatusBadRequest, gin.H{
			"success": false,
			"message": "bad request",
			"detail":  err.Error(),
		})
		return
	}

	// Insert data
	if err := utility.DB.Create(&participant).Error; err != nil {
		ctx.JSON(http.StatusInternalServerError, gin.H{
			"success": false,
			"message": "Internal server error",
			"detail":  err.Error(),
		})
		return
	}

	ctx.JSON(http.StatusOK, gin.H{
		"success": true,
		"message": "success insert data",
	})

}
