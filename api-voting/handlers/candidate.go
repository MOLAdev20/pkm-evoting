package handlers

import (
	"api-voting/models"
	"api-voting/utility"
	"net/http"

	"github.com/gin-gonic/gin"
)

func InsertCandidate(c *gin.Context) {
	var candidate models.Candidate

	if err := c.ShouldBindJSON(&candidate); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	if err := utility.DB.Create(&candidate).Error; err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": err.Error()})
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"message": "Candidate inserted successfully",
	})
}

func GetAllCandidate(ctx *gin.Context) {
	var candidate []models.Candidate

	result := utility.DB.Find(&candidate)

	if result.Error != nil {
		ctx.JSON(http.StatusInternalServerError, gin.H{
			"success": false,
			"message": "Internal server error",
			"detail":  result.Error.Error(),
		})
		return
	}

	ctx.JSON(http.StatusOK, gin.H{
		"success":    true,
		"message":    "Data fetched successfully",
		"candidates": candidate,
	})

}
