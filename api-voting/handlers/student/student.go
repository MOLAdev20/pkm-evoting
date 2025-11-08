package student

import (
	"net/http"

	"github.com/gin-gonic/gin"
)

func CreateStudent(ctx *gin.Context) {
	var form struct {
		NIM          string `form:"nim"`
		Name         string `form:"name"`
		JenisKelamin string `form:"jk"`
	}

	if err := ctx.ShouldBind(&form); err != nil {
		ctx.JSON(400, gin.H{"error": err.Error()})
		return
	}

	ctx.JSON(http.StatusOK, gin.H{
		"status": "success",
		"data":   form,
	})
}
